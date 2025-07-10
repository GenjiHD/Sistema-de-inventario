import { Routes } from '@angular/router';
import { ListaProductosComponent } from './components/lista-productos/lista-productos.component';
import { ListaUsuariosComponent } from './components/lista-usuarios/lista-usuarios.component';

export const routes: Routes = [
  {
    path: 'productos',
    component: ListaProductosComponent,
    title: 'Gestión de Productos' // Mejora SEO/Accesibilidad
  },
  {
    path: 'usuarios',
    component: ListaUsuariosComponent,
    title: 'Gestion de usuarios'
  },
  {
    path: '',
    pathMatch: 'full',
    redirectTo: 'usuarios'
  }
];
