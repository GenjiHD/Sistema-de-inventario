import { ComponentFixture, TestBed } from '@angular/core/testing';

import { InsertarReportesComponent } from './insertar-reportes.component';

describe('InsertarReportesComponent', () => {
  let component: InsertarReportesComponent;
  let fixture: ComponentFixture<InsertarReportesComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [InsertarReportesComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(InsertarReportesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
