export interface Producto {
  ProductoID?: number;
  NumeroControl: string;
  NumeroSerie: string | null;
  Descripcion: string;
  Modelo: string;
  Marca: string;
  Categoria: string;
  Factura: string;
  Cantidad: number;
  FechaAlta: string;  // o Date si prefieres
  FechaBaja: string | null;
  Valor: number;
}
