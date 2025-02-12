namespace Back_end.src.models
{
  public class Producto
  {
    public int ProductoID { get; set; }
    public string NumeroControl { get; set; }
    public string NumeroSerie { get; set; }
    public string Descripcion { get; set; }
    public string Modelo { get; set; }
    public string Marca { get; set; }
    public string Categoria { get; set; }
    public string Factura { get; set; }
    public int Cantidad { get; set; }
    public decimal Valor { get; set; }
  }

  public class ProductoNuevo
  {
    public string NumeroControl { get; set; }
    public string NumeroSerie { get; set; }
    public string Descripcion { get; set; }
    public string Modelo { get; set; }
    public string Marca { get; set; }
    public string Categoria { get; set; }
    public string Factura { get; set; }
    public int Cantidad { get; set; }
    public decimal Valor { get; set; }

  }
}
