import { Component, EventEmitter, Output, Input } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Usuarios } from '../../models/usuarios.model';

@Component({
  selector: 'app-editar-usuarios',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './editar-usuarios.component.html',
  styleUrl: './editar-usuarios.component.scss',
})
export class EditarUsuariosComponent {
  @Input() usuario: Usuarios | null = null;
  @Output() guardar = new EventEmitter<Usuarios>();
  @Output() cancelar = new EventEmitter<void>();
  @Output() Baja = new EventEmitter<Usuarios>();

  onGuardar() {
    if (this.usuario) {
      this.guardar.emit(this.usuario);
    }
  }

  onCancelar() {
    this.cancelar.emit();
  }

  OnDarDeBaja() {
    if (this.usuario) {
      this.Baja.emit(this.usuario);
    }
  }
}
