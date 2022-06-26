#include < amxmodx >
#include < amxmisc >
#include < asystem >
#include < dhudmessage >
#include < sqlx >

#define PLUGIN "Army System"
#define VERSION "2.1"
#define AUTHOR "OverGame"

#pragma tabsize 0

new const sPrefix[] = "!g[ASystem]!y"

new Handle:MYSQL_Tuple
new Handle:MYSQL_Connect

new g_Sql[5]

new g_ActiveMysql
new szPlayerMysql[33], szSteamId[35]
new g_MsgHud, MaxPlayers, gName[33]

enum _:PlData
{
	gExp, gLevel, gTempKey, gBonus
};

new UserData[33][PlData]

new const gRankNames[][] = 
{
	"R_0","R_1","R_2","R_3","R_4","R_5","R_6","R_7","R_8","R_9","R_10","R_11","R_12","R_13","R_14",		
	"R_15","R_16","R_17","R_18","R_19","R_20"
};

new const gLevels[] = 
{
	0,15,30,60,100,180,350,750,999,1500,2200,2800,3200,3900,4500,5000,5500,6000,7000,8000
};

new g_Informer, cl_r, cl_g, cl_b

public plugin_init() 
{
	register_plugin(PLUGIN, VERSION, AUTHOR)
	register_event("DeathMsg","EventDeath","a")
	register_logevent("save_mysql", 2, "1=Round_End")

	g_Sql[1] = register_cvar("as_hostname", "127.0.0.1")
	g_Sql[2] = register_cvar("as_username", "root")
	g_Sql[3] = register_cvar("as_password", "password")
	g_Sql[4] = register_cvar("as_database", "server1_asystem")
	
	g_Informer = register_cvar("as_informer", "1")
	
	cl_r = register_cvar("as_color_r", "255")
	cl_g = register_cvar("as_color_g", "255")
	cl_b = register_cvar("as_color_b", "255")
	
	MaxPlayers = get_maxplayers();
	g_MsgHud = CreateHudSyncObj();
	
	set_task(1.0,"Info",_,_,_, "b");
	
	register_dictionary("asystem_lang.txt" );

        set_task(1.0, "MYSQL_Load")
}

public plugin_natives()
{
	register_native("get_as_bonus", "native_get_as_bonus", 1);
	register_native("set_as_bonus", "native_set_as_bonus", 1);
	register_native("get_as_level", "native_get_as_level", 1);
	register_native("set_as_level", "native_set_as_level", 1);
	register_native("get_as_exp", "native_get_as_exp", 1);
	register_native("set_as_exp", "native_set_as_exp", 1);
}

public native_get_as_bonus(id)
{
	return UserData[id][gBonus]
}

public native_set_as_bonus(id, num)
{
	UserData[id][gBonus] = num
}

public native_get_as_level(id)
{
	return UserData[id][gLevel]
}

public native_set_as_level(id, num)
{
	UserData[id][gLevel] = num
}

public native_get_as_exp(id)
{
	return UserData[id][gExp]
}

public native_set_as_exp(id, num)
{
	UserData[id][gExp] = num
}

public client_putinserver(id)
{
	get_user_name(id, gName, 32)
}

public client_disconnect(id)
{
	new szError[512]
	new Handle:szUpdate
			
	szUpdate = SQL_PrepareQuery(MYSQL_Connect, "UPDATE `asystem` SET `level` = '%d', `name` = '%s', `exp` = '%d', `bonus` = '%d' WHERE `asystem`.`steamid` = '%s';", UserData[id][gLevel], gName, UserData[id][gExp], UserData[id][gBonus], szSteamId)

	if(!SQL_Execute(szUpdate)) 
	{
		SQL_QueryError(szUpdate, szError, charsmax( szError ))
		set_fail_state( szError )
	}
}

public EventDeath()
{
	new iKiller = read_data(1);
	new iVictim = read_data(2);
	new iHead = read_data(3);
	new gMsg[255]
	
	set_dhudmessage(243, 180, 48, 0.57, 0.75, 0, 1.0, 1.0, 0.1, 0.1)
	
	if( iHead && iKiller != iVictim && is_user_connected(iKiller) && is_user_connected(iVictim) && UserData[iKiller][gLevel] <= 19 )
	{
	    
		UserData[iKiller][gExp] += 3;
		UserData[iKiller][gBonus] += 3;
		
		format(gMsg, charsmax(gMsg), "+3 к опыту! (В голову)");
		
	} else 
	if( iKiller != iVictim && is_user_connected(iKiller) && is_user_connected(iVictim) && UserData[iKiller][gLevel] <= 19 )
	{
	
		UserData[iKiller][gExp] += 1;
		UserData[iKiller][gBonus] += 1;
		
	    format(gMsg, charsmax(gMsg), "+1 к опыту!");
		
	}
	
	check_level(iKiller);
	
	show_dhudmessage(iKiller, gMsg)
	
	return PLUGIN_CONTINUE;
}

public MYSQL_Load()
{
	new szHostname[30], szUsername[30], szPassword[30], szDatabase[30]
	new szError[512], szErr

	get_pcvar_string(g_Sql[1], szHostname, charsmax( szHostname ))
	get_pcvar_string(g_Sql[2], szUsername, charsmax( szUsername ))
	get_pcvar_string(g_Sql[3], szPassword, charsmax( szPassword ))
	get_pcvar_string(g_Sql[4], szDatabase, charsmax( szDatabase ))

	MYSQL_Tuple = SQL_MakeDbTuple(szHostname, szUsername, szPassword, szDatabase)
	MYSQL_Connect= SQL_Connect(MYSQL_Tuple, szErr, szError, charsmax( szError ))

	if(MYSQL_Connect == Empty_Handle)
		set_fail_state( szError )

	g_ActiveMysql = true
}

public client_connect(id)
{
	if(!is_user_bot(id) || !is_user_hltv(id))
	{
		set_task(1.0, "CheckPlayer", id)
		get_user_authid(id, szSteamId, 34)
	}
}

public CheckPlayer(id)
{
	if(!g_ActiveMysql)
	{
		set_task(1.0, "PlayerCheck", id)
	}

	new szError[512]
	new szMYSQLName[35]
	new Handle:szSelect

	szSelect = SQL_PrepareQuery(MYSQL_Connect, "SELECT * FROM asystem")

	if(!SQL_Execute(szSelect))
	{
		SQL_QueryError(szSelect, szError, charsmax( szError ))
		set_fail_state( szError )
	}

	while(SQL_MoreResults(szSelect))
	{
		SQL_ReadResult(szSelect, 1, szMYSQLName, charsmax( szMYSQLName ))
	
		if(equal(szMYSQLName, szSteamId))
		{
			UserData[id][gLevel] = SQL_ReadResult(szSelect, 3)
			UserData[id][gExp] = SQL_ReadResult(szSelect, 4)
			UserData[id][gBonus] = SQL_ReadResult(szSelect, 5)
			szPlayerMysql[id] = true

			break
		}else{
			SQL_NextRow(szSelect)
		}
	}	

	if(!szPlayerMysql[id])
	{
		new Handle:szInsert
		szInsert = SQL_PrepareQuery(MYSQL_Connect, "INSERT INTO `asystem` (`steamid`, `name`, `level`, `exp`, `bonus`) VALUES  ('%s', '%s', '0', '0', '0');", szSteamId, gName)

		if(!SQL_Execute(szInsert))
		{
			SQL_QueryError(szInsert, szError, charsmax( szError ))
			set_fail_state( szError )
		}
		szPlayerMysql[id] = true
	}
	
	while(UserData[id][gExp] >= gLevels[UserData[id][gLevel]]) 
	{
		UserData[id][gLevel]++;
	}
}

public save_mysql()
{
	for(new id = 0; id <= MaxPlayers; id++)
	{
		if(!is_user_bot(id) && is_user_connected(id))
		{
			new szError[512]
			new Handle:szUpdate
			
			szUpdate = SQL_PrepareQuery(MYSQL_Connect, "UPDATE `asystem` SET `level` = '%d', `name` = '%s', `exp` = '%d', `bonus` = '%d' WHERE `asystem`.`steamid` = '%s';", UserData[id][gLevel], gName, UserData[id][gExp], UserData[id][gBonus], szSteamId)

			if(!SQL_Execute(szUpdate)) 
			{
				SQL_QueryError(szUpdate, szError, charsmax( szError ))
				set_fail_state( szError )
			}
	    }
    }	
}

public check_level(id)
{
	if(UserData[id][gLevel] <= 0)
		UserData[id][gLevel] = 1;
		
	if(UserData[id][gExp] < 0)
		UserData[id][gExp] = 0;

	while(UserData[id][gExp] >= gLevels[UserData[id][gLevel]]) 
	{
		UserData[id][gLevel]++;
		static buffer[192]
		format(buffer, charsmax(buffer), "%s Игрок : !t%s !yполучил звание %t%L", sPrefix, gName, id, gRankNames[UserData[id][gLevel]]) 
		ChatColor(0, buffer);
	}
}

public Info()
{
	for(new id = 0; id <= MaxPlayers; id++)
	{
		if(!is_user_bot(id) && is_user_connected(id))
		{
		    static buffer[192]
		    if ( get_pcvar_num(g_Informer) == 1 )
			{
				set_hudmessage(get_pcvar_num(cl_r), get_pcvar_num(cl_g), get_pcvar_num(cl_b), 0.01, 0.20, 0, 15.0, 1.0, _, _, -1)
			
				static len;
				len = format(buffer, charsmax(buffer), "Звание : ");
				len += format(buffer[len], charsmax(buffer) - len, " %L", id, gRankNames[UserData[id][gLevel]]);
				if(UserData[id][gLevel] <= 19)
				{
					len += format(buffer[len], charsmax(buffer) - len, "^nОпыт : [ %d / %d ]", UserData[id][gExp], gLevels[UserData[id][gLevel]]);
				} else {
					len += format(buffer[len], charsmax(buffer) - len, "^nВы достигли максимальный уровень!");
				}
			} else 
			if ( get_pcvar_num(g_Informer) == 0 )
			{
			    
				set_hudmessage(get_pcvar_num(cl_r), get_pcvar_num(cl_g), get_pcvar_num(cl_b), -1.0, 0.89, 0, 15.0, 1.0, _, _, -1)
				format(buffer, charsmax(buffer), "Звание : %L | Опыт : %d / %d", id, gRankNames[UserData[id][gLevel]], UserData[id][gExp], gLevels[UserData[id][gLevel]]);
			}
			
			ShowSyncHudMsg(id, g_MsgHud, "%s", buffer);
		}
	}
	
	return PLUGIN_CONTINUE
}

stock ChatColor(const id, const input[], any:...)
{
	new count = 1, players[32]
	static msg[188]
	vformat(msg, 187, input, 3)
	
	replace_all(msg, 187, "!g", "^4")
	replace_all(msg, 187, "!y", "^1")
	replace_all(msg, 187, "!t", "^3")
	
	if (id) players[0] = id; else get_players(players, count, "ch")
	{
		for (new i = 0; i < count; i++)
		{
			if (is_user_connected(players[i]))
			{
				message_begin(MSG_ONE_UNRELIABLE, get_user_msgid("SayText"), _, players[i]);
				write_byte(players[i]);
				write_string(msg);
				message_end();
			}
		}
	}
}