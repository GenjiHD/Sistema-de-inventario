import { RenderMode, ServerRoute } from '@angular/ssr';
import { ListaProductosComponent } from './components/lista-productos/lista-productos.component';

export const serverRoutes: ServerRoute[] = [
  {
    path: '**',
    renderMode: RenderMode.Prerender
  }
];
