import { ApplicationConfig } from '@angular/core';
import {
  provideRouter,
  withComponentInputBinding
} from '@angular/router';
import { routes } from './app.routes';
import {
  provideHttpClient,
  withFetch
} from '@angular/common/http';
import {
  provideClientHydration,
  withEventReplay
} from '@angular/platform-browser';

export const appConfig: ApplicationConfig = {
  providers: [
    provideRouter(routes, withComponentInputBinding()), // Bind route params to inputs
    provideHttpClient(withFetch()), // Usa Fetch API en lugar de XHR
    provideClientHydration(withEventReplay()), // Mejor SSR
  ]
};
