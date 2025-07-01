import { Component, OnInit } from '@angular/core';
import { ProductoService } from '../services/producto.service';
import { Producto } from '../../models/producto.model';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';
import { FormsModule } from '@angular/forms';
import { EditarProductoComponent } from '../editar-productos/editar-productos.component';

@Component({
  selector: 'app-lista-productos',
  standalone: true,
  imports: [CommonModule, RouterModule, FormsModule,],
  templateUrl: './lista-productos.component.html',
  styleUrls: ['./lista-productos.component.css']
})
export class ListaProductosComponent implements OnInit {
  productos: Producto[] = [];
  loading: boolean = true;

  modalVisible: boolean = false;
  productoEditando: Producto | null = null;

  constructor(private productoservice: ProductoService) {}

  ngOnInit(): void {
    this.cargarProductos();
  }

  cargarProductos() {
    this.productoservice.getProductos().subscribe({
      next: (data: Producto[]) => {
        this.productos = data;
        this.loading = false;
      },
      error: (error) => {
        console.error('Error al cargar los productos: ', error);
        this.loading = false;
      }
    });
  }

  onFechaBajaChange(producto: Producto, nuevaFecha: string) {
    const fecha = nuevaFecha ? nuevaFecha : null;
    producto.FechaBaja = fecha;

    this.productoservice.updateProducto(producto).subscribe({
      next: () => {
        console.log('Fecha de baja actualizada');
      },
      error: (err) => {
        console.error('Error al actualizar fecha de baja:', err);
      }
    });
  }

  editarProducto(producto: Producto): void {
    this.productoEditando = { ...producto }; // clon del producto
    this.modalVisible = true;
  }

  cerrarModal(): void {
    this.modalVisible = false;
    this.productoEditando = null;
  }

  guardarCambiosDesdeModal(productoActualizado: Producto): void {
    this.productoservice.updateProducto(productoActualizado).subscribe({
      next: () => {
        console.log('Producto actualizado');
        this.cargarProductos();
        this.cerrarModal();
      },
      error: (err) => {
        console.error('Error al actualizar producto: ', err);
      }
    });
  }
}

