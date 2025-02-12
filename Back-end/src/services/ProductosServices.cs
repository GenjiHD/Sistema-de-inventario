using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using MySql.Data.MySqlClient;
using MySql.Data;

namespace Backend.src.services
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

  [HttpGet]
  public async Task <IActionResult> getProductos(){
    var productos = new List<Productos>();

    try
    {
      using (var connection = new MySqlConnection(connString))
      {
        await connection.OpenAsync();
        var query = "SELECT * FROM Productos";
        using (var command = new MySqlCommand(query, connection))
        using (var reader = await command.ExecuteReaderAsync())
        {
          while (await reader.ReadAsync())
          {
            productos.Add(new Producto{
                ProductoID = reader.GetInt32("ProductoID"),
                NumeroControl = reader.GetString("NumeroControl"),
                NumeroSerie = reader.GetString("NumeroSerie"),
                Descripcion = reader.GetString("Descripcion"),
                Modelo = reader.GetString("Modelo"),
                Marca = reader.GetString("Marca"),
                Categoria = reader.GetString("Categoria"),
                Factura = reader.GetString("Factura"),
                Cantidad = reader.GetInt32("Cantidad"),
                Valor = reader.GetDecimal("Valor")
            });
          }
        }
      }
      return Ok(Productos);
    }
    catch (Exception ex)
    {
      return StatusCode(500, new { error = "No se puede obtener la lista de productos", detalles = ex.Message });
    }
  }
}
