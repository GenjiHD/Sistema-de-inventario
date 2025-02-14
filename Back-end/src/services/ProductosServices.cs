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

  [HttpGet("buscar-por-serie/{NumeroSerie}")]

  public async Task <IActionResult> getProductosNumeroSerie(string numeroSerie) {

    try{
      using (var connection = new MySqlConnection(connString)){
        await connection.OpenAsync();
        var query = "SELECT * FROM Productos WHERE NumeroSerie = @numeroSerie";
        using (var command = new MySqlCommand(query,connection)){
          command.Parameters.AddWithValue("@numeroSerie",numeroSerie);
          using (var reader = await command.ExecuteReaderAsync()){
            if (await reader.ReadAsync()){
              var producto = new Productos{
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
              };
              return Ok(producto);
            }
            else{
              return NotFound(new {error = "Ese numero de serie no existe"});
            }
          }
        }
      }
    }catch (Exception ex){
      return StatusCode(500, new{error = "Error al buscar el producto", detalles = ex.Message});
    }
  }

   [HttpGet("buscar-por-control/{NumeroControl}")]

  public async Task <IActionResult> getProductosNumeroSerie(string numeroControl) {

    try{
      using (var connection = new MySqlConnection(connString)){
        await connection.OpenAsync();
        var query = "SELECT * FROM Productos WHERE NumeroControl = @numeroControl";
        using (var command = new MySqlCommand(query,connection)){
          command.Parameters.AddWithValue("@numeroControl",numeroControl);
          using (var reader = await command.ExecuteReaderAsync()){
            if (await reader.ReadAsync()){
              var producto = new Productos{
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
              };
              return Ok(producto);
            }
            else{
              return NotFound(new {error = "Ese numero de control no existe"});
            }
          }
        }
      }
    }catch (Exception ex){
      return StatusCode(500, new{error = "Error al buscar el producto", detalles = ex.Message});
    }
  }

   [HttpPost]

     public async Task <IActionResult> AgregarProducto([FromBody] ProductoNuevo nuevo){
       try{
         using (var connection = new MySqlConnection(connString)){
           await connection.OpenAsync();
           var query = @"
             INSERT INTO Productos (NumeroControl, NumeroSerie, Descripcion, Modelo, Marca, Categoria, Factura, Cantidad, Valor)
             VALUES (@NumeroControl, @NumeroSerie, @Descripcion, @Modelo, @Marca, @Categoria, @Factura, @Cantidad, @Valor)";
           using (var command = new MySqlCommand(query, connection)){
             command.Parameters.AddWithValue("@NumeroControl", nuevo.NumeroControl);
             command.Parameters.AddWithValue("@NumeroSerie", nuevo.NumeroSerie);
             command.Parameters.AddWithValue("@Descripcion", nuevo.Descripcion);
             command.Parameters.AddWithValue("@Modelo", nuevo.Modelo);
             command.Parameters.AddWithValue("@Marca", nuevo.Marca);
             command.Parameters.AddWithValue("@Categoria", nuevo.Categoria);
             command.Parameters.AddWithValue("@Factura", nuevo.Factura);
             command.Parameters.AddWithValue("@Cantidad", nuevo.Cantidad);
             command.Parameters.AddWithValue("@Valor", nuevo.Valor);

             await command.ExecuteNonQueryAsync();
             return Ok(new {message = "Producto agregado correctamente"});
           }
         }
       }catch (Exception ex){
         return StatusCode(500, new{error = "Error al agregar el producto", detalles = ex.Message});
       }
    }

   [HttpPut("por-serie/{numeroSerie}")]

    public async Task <IActionResult> ActualizarProductoPorNumeroSeria(string numeroSerie[FromBody] Producto modificacion){

       if (modificacion == null || numeroSerie != moificacion.numeroSerie){
         return BadRequest(new {error = "Datos no validos o el numero de serie no coincide"});
       }

       try{
         using (var connection = new MySqlConnection(connString)){
           await connection.OpenAsync();
           var query = @"UPDATE Productos
             SET NumeroControl = @NumeroControl, Descripcion = @Descripcion, Modelo = @Modelo,
                 Marca = @Marca, Categoria = @Categoria, Factura = @Factura,
                 Cantidad = @Cantidad,  Valor = @Valor
                   WHERE NumeroSerie = @numeroSerie";

           using (var command = MySqlCommand(query, connection)){
             command.Parameters.AddWithValue("@NumeroControl", modificacion.NumeroControl);
             command.Parameters.AddWithValue("@Descripcion", modificacion.Descripcion);
             command.Parameters.AddWithValue("@Modelo", modificacion.Modelo);
             command.Parameters.AddWithValue("@Marca", modificacion.Marca);
             command.Parameters.AddWithValue("@Categoria", modificacion.Categoria);
             command.Parameters.AddWithValue("@Factura", modificacion.Factura);
             command.Parameters.AddWithValue("@Cantidad", modificacion.Cantidad);
             command.Parameters.AddWithValue("@Valor", modificacion.Valor);
             command.Parameters.AddWithValue("@numeroSerie", modificacion.numeroSerie);

             var rows = await command.ExecuteReaderAsync();

             if(rows > 0){
               return Ok(new {message = "Producto actualizado correctamente"});
             }
             else{
               return NotFound(new{error = "Producto no encontrado"});
             }
           }
         }
       }catch (Exception ex){
         return StatusCode(500, new{error = "Error al actualizar los datos del producto", detalles = ex.Message});
       }
    }

    [HttpPut("por-control/{NumeroControl}")]

    public async Task <IActionResult> ActualizarProductoPorNumeroControl(string numeroControl[FromBody] Producto modificacion){

       if (modificacion == null || numeroControl != moificacion.numeroControl){
         return BadRequest(new {error = "Datos no validos o el numero de control no coincide"});
       }

       try{
         using (var connection = new MySqlConnection(connString)){
           await connection.OpenAsync();
           var query = @"UPDATE Productos
             SET NumeroSerie = @NumeroSerie, Descripcion = @Descripcion, Modelo = @Modelo,
                 Marca = @Marca, Categoria = @Categoria, Factura = @Factura,
                 Cantidad = @Cantidad,  Valor = @Valor
                   WHERE NumeroControl = @numeroControl";

           using (var command = MySqlCommand(query, connection)){
             command.Parameters.AddWithValue("@NumeroSerie", modificacion.NumeroSerie);
             command.Parameters.AddWithValue("@Descripcion", modificacion.Descripcion);
             command.Parameters.AddWithValue("@Modelo", modificacion.Modelo);
             command.Parameters.AddWithValue("@Marca", modificacion.Marca);
             command.Parameters.AddWithValue("@Categoria", modificacion.Categoria);
             command.Parameters.AddWithValue("@Factura", modificacion.Factura);
             command.Parameters.AddWithValue("@Cantidad", modificacion.Cantidad);
             command.Parameters.AddWithValue("@Valor", modificacion.Valor);
             command.Parameters.AddWithValue("@numeroControl", modificacion.numeroControl);

             var rows = await command.ExecuteReaderAsync();

             if(rows > 0){
               return Ok(new {message = "Producto actualizado correctamente"});
             }
             else{
               return NotFound(new{error = "Producto no encontrado"});
             }
           }
         }
       }catch (Exception ex){
         return StatusCode(500, new{error = "Error al actualizar los datos del producto", detalles = ex.Message});
       }
    }

}
