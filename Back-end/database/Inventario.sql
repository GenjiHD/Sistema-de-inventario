create database RecursosMaterialesInventario;

use RecursosMaterialesInventario;

-- Creacion de tablas

create table Usuario (
	UsuarioID int auto_increment not null primary key,
    Nombre varchar (100) not null,
    Contraseña varchar (20) not null,
    Puesto varchar (30),
    Estado bit (1) not null
);

create table Productos (
	ProductoID int auto_increment not null primary key,
    NumeroControl varchar (30),
    NumeroSerie varchar (30),
    Descripcion varchar (500),
    Modelo varchar (50),
    Categoria varchar (30),
    Factura varchar (30),
    Cantidad int,
    FechaAlta date not null,
    FechaBaja date,
    Valor decimal (10,2)
);

create table TipoMovimiento (
	TipoMovID int auto_increment not null primary key,
    Descripcion varchar (20)
);

create table Municipios (
	MunicipioID varchar (2) primary key not null,
    Descripcion varchar (50)
);

create table Delegaciones (
	DelegacionID varchar (3) primary key not null,
    MunicipioID varchar (2),
    Descripcion varchar (50)
);

create table Departamentos (
	DeptoID varchar (2) primary key not null,
    Descripcion varchar (60)
);

create table ReporteMovimiento (
	ReporteID int auto_increment not null primary key,
    ProductoID int,
    UsuarioID int,
    DeleOrigen varchar (2),
    DeleDestino varchar (2),
    DeptoOrigen varchar (2),
    DeptoDestino varchar (2),
    TipoMovID int,
    FechaMov date
);

alter table Delegaciones add constraint fk_municipios foreign key (MunicipioID) references Municipios (MunicipioID);
alter table ReporteMovimiento add constraint fk_productos foreign key (ProductoID) references Productos (ProductoID);
alter table ReporteMovimiento add constraint fk_usuarios foreign key (UsuarioID) references Usuario (UsuarioID);
alter table ReporteMovimiento add constraint fk_TipoMov foreign key (TipoMovID) references TipoMovimiento (TipoMovID);
alter table ReporteMovimiento add constraint fk_DeptoDestino foreign key (DeptoDestino) references Departamentos (DeptoID);
alter table ReporteMovimiento add constraint fk_DeptoOrigen foreign key (DeptoOrigen) references Departamentos (DeptoID);
alter table ReporteMovimiento add constraint fk_DeleDestino foreign key (DeleDestino) references Delegaciones (DelegacionID);
alter table ReporteMovimiento add constraint fk_DeleOrigen foreign key (DeleOrigen) references Delegaciones (DelegacionID);
