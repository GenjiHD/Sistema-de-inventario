import { Component, OnInit } from '@angular/core';
import { ProductoService } from '../services/producto.service';
import { Producto } from '../../models/producto.model';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';
import { FormsModule } from '@angular/forms';
import { EditarProductoComponent } from '../editar-productos/editar-productos.component';
import { InsertarProductosComponent } from '../insertar-productos/insertar-productos.component';

@Component({
  selector: 'app-lista-productos',
  standalone: true,
  imports: [CommonModule, RouterModule, FormsModule, EditarProductoComponent, InsertarProductosComponent],
  templateUrl: './lista-productos.component.html',
  styleUrls: ['./lista-productos.component.css']
})
export class ListaProductosComponent implements OnInit {
  productos: Producto[] = [];

  paginaActual: number = 1;
  productosPorPagina: number = 50;

  loading: boolean = true;

  modalInsertarVisible: boolean = false;


  modalVisible: boolean = false;
  productoEditando: Producto | null = null;

  constructor(private productoservice: ProductoService) {}

  ngOnInit(): void {
    this.cargarProductos();
  }

  get totalPaginas(): number {
    return Math.ceil(this.productos.length / this.productosPorPagina);
  }

  abrirFormularioInsertar(): void {
    this.modalInsertarVisible = true;
  }

  cerrarModalInsertar(): void {
    this.modalInsertarVisible = false;
  }

  get productosVisibles(): Producto[] {
    const inicio = (this.paginaActual - 1) * this.productosPorPagina;
    const fin = inicio + this.productosPorPagina;
    return this.productos.slice(inicio, fin);
  }

  get paginasVisibles(): number[] {
    const total = this.totalPaginas;
    const actual = this.paginaActual;
    const rango = 2;

    const inicio = Math.max(1, actual - rango);
    const fin = Math.min(total, actual + rango);

    const paginas: number[] = [];
    for (let i = inicio; i <= fin; i++) {
      paginas.push(i);
    }
    return paginas;
  }

  cambiarPagina(pagina: number): void {
    if (pagina >= 1 && pagina <= this.totalPaginas) {
      this.paginaActual = pagina;
    }
  }

  cargarProductos(): void {
    this.loading = true;
    this.productoservice.getProductos().subscribe({
      next: (data: Producto[]) => {
        this.productos = data;
        this.paginaActual = 1;
        this.loading = false;
      },
      error: (error) => {
        console.error('Error al cargar los productos: ', error);
        this.loading = false;
      }
    });
  }

  onFechaBajaChange(producto: Producto, nuevaFecha: string): void {
    const fecha = nuevaFecha ? nuevaFecha : null;
    producto.FechaBaja = fecha;

    this.productoservice.updateProductos(producto).subscribe({
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
    this.productoservice.updateProductos(productoActualizado).subscribe({
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

  guardarNuevoProducto(nuevoProducto: Producto): void {
    this.productoservice.createProductos(nuevoProducto).subscribe({
      next: () => {
        console.log('Producto insertardo correctamente');
        this.cargarProductos();
        this.cerrarModalInsertar();
      },
      error: (err: any) => {
        console.error('Error al insertar el producto: ', err);
      }
    });
  }
}

