import { Component, EventEmitter, Input, Output } from '@angular/core';
import { Producto } from '../../models/producto.model';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-editar-producto',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './editar-productos.component.html',
  styleUrls: ['./editar-productos.component.css']
})

export class EditarProductoComponent {
  @Input() producto: Producto | null = null;
  @Output() guardar = new EventEmitter<Producto>();
  @Output() cancelar = new EventEmitter<void>();

  onGuardar() {
    if (this.producto) {
      this.guardar.emit(this.producto);
    }
  }

  onCancelar() {
    this.cancelar.emit();
  }
}
