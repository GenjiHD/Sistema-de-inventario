import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';
import { FormsModule } from '@angular/forms';
import { UsuariosService } from '../services/usuarios.service';
import { Usuarios } from '../../models/usuarios.model';
import { EditarUsuariosComponent } from '../editar-usuarios/editar-usuarios.component';
import { InsertarUsuariosComponent } from '../insertar-usuarios/insertar-usuarios.component';

@Component({
  selector: 'app-lista-usuarios',
  standalone: true,
  imports: [CommonModule, RouterModule, FormsModule, EditarUsuariosComponent, InsertarUsuariosComponent],
  templateUrl: './lista-usuarios.component.html',
  styleUrl: './lista-usuarios.component.css',
})
export class ListaUsuariosComponent implements OnInit {
  usuarios: Usuarios[] = [];
  usuariosVisibles: Usuarios[] = [];

  loading: boolean = true;

  modalInsertarVisible: boolean = false;
  modalVisible: boolean = false;

  usuarioEditado: Usuarios = {
    UsuarioID: 0,
    Nombre: '',
    Contrasena: '',
    Puesto: '',
    Estado: true
  };

  // Paginación
  paginaActual: number = 1;
  totalPaginas: number = 1;
  paginasVisibles: number[] = [];
  readonly USUARIOS_POR_PAGINA = 10;

  constructor(private usuariosService: UsuariosService) {}

  ngOnInit(): void {
    this.cargarUsuarios();
  }

  cargarUsuarios(): void {
    this.loading = true;
    this.usuariosService.getUsuarios().subscribe({
      next: (data: Usuarios[]) => {
        this.usuarios = data;
        this.totalPaginas = Math.ceil(this.usuarios.length / this.USUARIOS_POR_PAGINA);
        this.generarPaginasVisibles();
        this.actualizarUsuariosVisibles();
        this.loading = false;
      },
      error: (error) => {
        console.error('Error al cargar los usuarios: ', error);
        this.loading = false;
      }
    });
  }

  actualizarUsuariosVisibles(): void {
    const inicio = (this.paginaActual - 1) * this.USUARIOS_POR_PAGINA;
    const fin = inicio + this.USUARIOS_POR_PAGINA;
    this.usuariosVisibles = this.usuarios.slice(inicio, fin);
  }

  generarPaginasVisibles(): void {
    this.paginasVisibles = Array.from({ length: this.totalPaginas }, (_, i) => i + 1);
  }

  cambiarPagina(pagina: number): void {
    if (pagina >= 1 && pagina <= this.totalPaginas) {
      this.paginaActual = pagina;
      this.actualizarUsuariosVisibles();
    }
  }

  editarUsuarios(usuarios: Usuarios): void {
    this.usuarioEditado = { ...usuarios };
    this.modalVisible = true;
  }

  cerrarModal(): void {
    this.modalVisible = false;
    this.usuarioEditado = {
      UsuarioID: 0,
      Nombre: '',
      Contrasena: '',
      Puesto: '',
      Estado: true
    };
  }

  guardarNuevosDatos(usuarioActualizado: Usuarios): void {
    this.usuariosService.updateUsuario(usuarioActualizado).subscribe({
      next: () => {
        console.log('Datos del usuario actualizados');
        this.cargarUsuarios();
        this.cerrarModal();
      },
      error: (error: any) => {
        console.error('Error al actualizar los datos del usuario: ', error);
      }
    });
  }

  abrirFormularioInsertar(): void {
    this.modalInsertarVisible = true;
  }

  cerrarModalInsertar(): void {
    this.modalInsertarVisible = false;
  }

  guardarNuevoUsuario(nuevoUsuario: Usuarios): void {
    this.usuariosService.createUsuario(nuevoUsuario).subscribe({
      next: () => {
        console.log('El usuario ha sido creado correctamente');
        this.cargarUsuarios();
        this.cerrarModalInsertar();
      },
      error: (error: any) => {
        console.error('Error al crear el nuevo usuario: ', error);
      }
    });
  }

  darDeBajaUsuarios(usuario: Usuarios): void {
    if (confirm(`¿Deseas dar de baja a este usuario ${usuario.Nombre}?`)) {
      if (usuario.UsuarioID !== undefined) {
        this.usuariosService.deactivateUsuarios(usuario.UsuarioID).subscribe({
          next: () => {
            console.log('El usuario ha sido dado de baja correctamente');
            this.cargarUsuarios();
            this.cerrarModal();
          },
          error: (error) => {
            console.error('Error al dar de baja al usuario: ', error);
          }
        });
      }
    }
  }

  guardarCambiosDesdeModal(usuario: Usuarios): void {
    this.guardarNuevosDatos(usuario);
  }
}

