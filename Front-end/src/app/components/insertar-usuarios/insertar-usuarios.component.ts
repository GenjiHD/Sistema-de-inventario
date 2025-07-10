import { ChangeDetectionStrategy, Component, EventEmitter, Output } from '@angular/core';
import { Usuarios } from '../../models/usuarios.model';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-insertar-usuarios',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './insertar-usuarios.component.html',
  styleUrl: './insertar-usuarios.component.css',
})
export class InsertarUsuariosComponent {
  @Output() guardar = new EventEmitter<Usuarios>();
  @Output() cancelar = new EventEmitter<void>();

  nuevoUsuario: Usuarios = {
    Nombre: '',
    Contrasena: '',
    Puesto: '',
    Estado: true
  };

  onGuardar(): void {
    this.guardar.emit(this.nuevoUsuario);
  }

  onCancelar(): void {
    this.cancelar.emit();
  }

  mostrarPassword = false;

  togglePassword() {
    this.mostrarPassword = !this.mostrarPassword;
  }
}
