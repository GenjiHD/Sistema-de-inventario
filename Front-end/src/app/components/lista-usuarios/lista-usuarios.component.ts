import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';
import { FormsModule } from '@angular/forms';
import { UsuariosService } from '../services/usuarios.service';
import { Usuarios } from '../../models/usuarios.model''

@Component({
  selector: 'app-lista-usuarios',
  standalone: true,
  imports: [],
  templateUrl: './lista-usuarios.component.html',
  styleUrl: './lista-usuarios.component.scss',
})

export class ListaUsuariosComponent {
  usuarios: Usuarios[] = [];

  loading: boolean = true;

  constructor(private usuariosService: UsuariosService) {}

  ng OnInit(): void {
    this.cargarUsuarios();
  }

  cargarUsuarios(): void {
    this.loading = true;
    this.usuariosService.getUsuarios().subscribe({
      next: (data: Usuarios[]) => {
        this.usuarios = data;
        this.loading = false;
      },
      error: (error) => {
        console.error('Error al cargar los usuarios: ', error);
        this.loading = false;
      }
    });
  }
}
