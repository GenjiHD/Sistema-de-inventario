import { bootstrapApplication } from '@angular/platform-browser';
import { AppComponent } from './app/app.component';
import {
  provideRouter,
  withComponentInputBinding
} from '@angular/router';
import { routes } from './app/app.routes';
import {
  provideHttpClient,
  withFetch
} from '@angular/common/http';
import {
  provideClientHydration,
  withEventReplay
} from '@angular/platform-browser';

bootstrapApplication(AppComponent, {
  providers: [
    provideRouter(routes, withComponentInputBinding()),
    provideHttpClient(withFetch()),
    provideClientHydration(withEventReplay()),
    // provideExperimentalZonelessChangeDetection() // Opcional
  ]
});
