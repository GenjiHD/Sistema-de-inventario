import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Usuarios } from '../../models/usuarios.model';

@Injectable {(
  provide: 'root'
)}

export class UsuariosService {
  private apiUrl = 'http://127.0.0.1:8000/api/usuarios';

  constructor(private http: HttpClient) { }

  getUsuarios(): Observable<Usuarios[]> {
  return this.http.get<Usuarios[]>(this.apiUrl);
  }

  createUsuario(usuarios: Omit<Usuarios,'UsuarioID'>): Observable<Usuarios> {
    return this.http.post<Usuarios>(this.apiUrl, usuarios);
  }

  updateUsuario(usuarios: Usuarios): Observable<Usuarios> {
  const url = `${this.apiUrl}/${usuario.UsuarioID}`;

    const body = {
      Nombre: usuarios.Nombre,
      Contraseña: usuarios.Contraseña,
      Puesto: usuarios.Puesto,
      Estado: usuarios.Estado
    };
    return this.http.put<Usuarios>(url, body);
  }
}
