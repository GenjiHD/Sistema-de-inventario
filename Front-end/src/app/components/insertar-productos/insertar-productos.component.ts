import { ChangeDetectionStrategy, Component, EventEmitter, Output } from '@angular/core';
import { Producto } from '../../models/producto.model';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-insertar-productos',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './insertar-productos.component.html',
  styleUrl: './insertar-productos.component.css',
})
export class InsertarProductosComponent {
  @Output() guardar = new EventEmitter<Producto>();
  @Output() cancelar = new EventEmitter<void>();

  nuevoProducto: Producto = {
    NumeroControl: '',
    NumeroSerie: '',
    Descripcion: '',
    Modelo: '',
    Marca: '',
    Categoria:'',
    Factura: '',
    Cantidad: 1,
    FechaAlta: new Date().toISOString().substring(0, 10),
    FechaBaja: null,
    Valor: 0,
  };

  onGuardar(): void {
    this.guardar.emit(this.nuevoProducto);
  }

  onCancelar(): void {
    this.cancelar.emit();
  }
}
