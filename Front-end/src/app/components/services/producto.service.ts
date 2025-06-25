import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  provideIn: 'root'
})

export class ProductoService {
  private apiUrl = 'http://127.0.0.1:8000/api/prodcutos';

  constructor(private http: HttpClient) { }

  getProductos(): Observable<any[]> {
    return this.http.get<any[]>(this.apiUrl);
  }
}
