import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
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

  updateProducto(producto: Producto): Observable<Producto> {
      const url = `${this.apiUrl}/${producto.ID}`;

    const body = {
      FechaBaja: producto.FechaBaja || null,
    };

    return this.http.put<Producto>(url, body);
  }
}

