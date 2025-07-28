# Creacion de tablas
## Tabla unidad_medida
````
CREATE TABLE public.unidad_medida
(
    id serial NOT NULL,
    codigo character varying(5) NOT NULL,
    unidad_medida character varying(50) NOT NULL,
    PRIMARY KEY (id)
);

ALTER TABLE IF EXISTS public.unidad_medida
    OWNER to postgres;
````
## Tabla rubro
````
CREATE TABLE IF NOT EXISTS public.rubro
(
    id integer NOT NULL DEFAULT nextval('rubro_id_seq'::regclass),
    rubro character varying(50) COLLATE pg_catalog."default",
    CONSTRAINT rubro_pkey PRIMARY KEY (id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.rubro
    OWNER to postgres;
````
## Tabla condicion_iva
````
CREATE TABLE IF NOT EXISTS public.condicion_iva
(
    id integer NOT NULL DEFAULT nextval('condicion_iva_id_seq'::regclass),
    codigo smallint NOT NULL,
    condicion_iva character varying(50) COLLATE pg_catalog."default" NOT NULL,
    alicuota numeric(10,3),
    CONSTRAINT condicion_iva_pkey PRIMARY KEY (id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.condicion_iva
    OWNER to postgres;
````
## Tabla producto_servicio
````
CREATE TABLE IF NOT EXISTS public.producto_servicio
(
    id integer NOT NULL DEFAULT nextval('producto_servicio_id_seq'::regclass),
    id_rubro integer NOT NULL DEFAULT nextval('producto_servicio_id_rubro_seq'::regclass),
    tipo character(1) COLLATE pg_catalog."default",
    id_unidad_medida integer NOT NULL DEFAULT nextval('producto_servicio_id_unidad_medida_seq'::regclass),
    codigo character varying(20) COLLATE pg_catalog."default",
    producto_servicio character varying(255) COLLATE pg_catalog."default",
    id_condicion_iva integer NOT NULL DEFAULT nextval('producto_servicio_id_condicion_iva_seq'::regclass),
    precio_bruto_unitario numeric(30,2),
    CONSTRAINT producto_servicio_pkey PRIMARY KEY (id),
    CONSTRAINT r_condicion_iva_producto_servicio FOREIGN KEY (id_condicion_iva)
        REFERENCES public.condicion_iva (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT r_rubro_producto_servicio FOREIGN KEY (id_rubro)
        REFERENCES public.rubro (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT r_unidad_medida_producto_servicio FOREIGN KEY (id_unidad_medida)
        REFERENCES public.unidad_medida (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.producto_servicio
    OWNER to postgres;
````