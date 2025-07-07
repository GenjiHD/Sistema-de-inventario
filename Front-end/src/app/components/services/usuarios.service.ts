import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Usuarios } from '../../models/usuarios.model';

@Injectable {(
  provide: 'root'
)}

export class UsuariosService {
  private apiUrl = 'http://127.0.0.1:8000/api/usuarios';
}
