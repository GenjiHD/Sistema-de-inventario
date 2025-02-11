using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using MySql.Data.MySqlClient;
using MySql.Data;

namespace ProductosServices
{
  [Route("api/[controller]")]
  [ApiController]

  private readonly string connString;

  connString = new MySqlConnectionStringBuilder
  {
    Server = "127.0.0.1",
    UserID = "root",
    Password = "",
    Database = "RecursosMaterialesInventario",
    Port = 3306,
    SslMode = MySqlSslMode.Node
  }.ToString();

  

}
