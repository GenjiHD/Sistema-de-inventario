import { Component, OnInit } from '@angular/core';
import { ProductoService } from '../services/producto.service';
import { Producto } from '../../models/producto.model';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';

@Component({
  selector: 'app-lista-productos',
  standalone: true,
  imports: [CommonModule, RouterModule],
  templateUrl: './lista-productos.component.html', // Ruta corregida (usa ./)
  styleUrls: ['./lista-productos.component.css']
})
export class ListaProductosComponent implements OnInit {
  productos: Producto[] = [];
  loading: boolean = true;

  constructor(private productoservice: ProductoService) { }

  ngOnInit(): void {
    this.cargarProductos();
  }

  cargarProductos() {
    this.productoservice.getProductos().subscribe({
      next: (data: Producto[]) => { // Tipo explícito añadido
        this.productos = data;
        this.loading = false;
      },
      error: (error) => {
        console.error('Error al cargar los productos: ', error);
        this.loading = false;
      }
    });
  }
}
