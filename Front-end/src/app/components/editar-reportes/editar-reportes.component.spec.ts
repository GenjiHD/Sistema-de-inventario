import { ComponentFixture, TestBed } from '@angular/core/testing';

import { EditarReportesComponent } from './editar-reportes.component';

describe('EditarReportesComponent', () => {
  let component: EditarReportesComponent;
  let fixture: ComponentFixture<EditarReportesComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [EditarReportesComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(EditarReportesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
