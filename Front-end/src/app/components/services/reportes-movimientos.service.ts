import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Reporte } from '../../models/reporte-moviminetos.model';

@Injectable({
 providedIn: 'root'
})

export class ReporteService {
  private apiUrl = 'http://127.0.0.1:8000/api/reportes-movimientos';

  constructor(private http: HttpClient) { }

  getReportes(): Observable<Reportes[]> {
    return this.http.get<Reporte[]>(this.apiUrl);
  }

  createReporte(reporte: Omit<Reporte, 'ReporteID'>): Observable<Reportes> {
    const headers = new HttpHeaders({ 'Content-type':'application/json' });
    return this.http.post<Reporte>(this.apiUrl, reporte, { headers });
  }

  updateReportes(reporte: Reportes): Observable<Reportes> {
    const url = `${this.apiUrl}/${reporte.ReporteID}`;
    const headers = new HttpHeaders({ 'Content-type':'application/json' });

    const body = {
      ProductoID: reporte.ProductoID,
      UsuarioID: reporte.UsuarioID,
      DeleOrigen: reporte.DeleOrigen,
      DeleDestino: reporte.DeleDestino,
      DeptoOrigen: reporte.DeptoOrigen,
      DeptoDestino: reporte.DeptoDestino,
      TipoMovID: reporte.TipoMovID,
      FechaMov: reporte.FechaMov
    };
    return this.http.put<Reporte>(url, body, { headers });
  }
}
