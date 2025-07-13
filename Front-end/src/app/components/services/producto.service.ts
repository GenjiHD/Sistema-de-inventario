import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Producto } from '../../models/producto.model';

@Injectable({
  providedIn: 'root'
})
export class ProductoService {
  private apiUrl = 'http://127.0.0.1:8000/api/productos';

  constructor(private http: HttpClient) { }

  getProductos(): Observable<Producto[]> {
    return this.http.get<Producto[]>(this.apiUrl);
  }

  createProductos(producto: Omit<Producto, 'ProductoID'>): Observable<Producto> {
    const headers = new HttpHeaders({ 'Content-type': 'application/json' });
    return this.http.post<Producto>(this.apiUrl, producto, { headers });
  }

  updateProductos(producto: Producto): Observable<Producto> {
    const url = `${this.apiUrl}/${producto.ProductoID}`;
    const headers = new HttpHeaders({ 'Content-type': 'application/json' });

    const body = {
      NumeroControl: producto.NumeroControl,
      NumeroSerie: producto.NumeroSerie,
      Descripcion: producto.Descripcion,
      Marca: producto.Marca,
      Modelo: producto.Modelo,
      Valor: producto.Valor,
      FechaAlta: producto.FechaAlta
    };
    return this.http.put<Producto>(url, body, { headers });
  }
}

