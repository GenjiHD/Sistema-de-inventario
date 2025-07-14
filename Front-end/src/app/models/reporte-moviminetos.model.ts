export interface ReporteMovimiento {
  ReporteID?: number;
  ProductoID: number;
  UsuarioID: number;
  DeleOrigen: string;
  DeleDestino: string;
  DeptoOrigen: string;
  DeptoDestino: string;
  TipoMovID: number;
  FechaMov: string;
}
