export interface SelectType<T> {
  label: string,
  value: T
}

export interface Region {
  id: number;
  nombre: string;
}

export interface Provincia {
  id: number;
  nombre: string;
  region_id: number;
}

export interface Ciudad {
  id: number;
  nombre: string;
  provincia_id: number;
}

export interface Calle {
  id: number;
  nombre: string;
  ciudad_id: number;
}

/**
  * Se utiliza para renderizar la tabla.
*/
export interface TableCalle {
  id: number;
  nombre: string;
  ciudad: string;
  provincia: string;
  region: string;
}

/**
  * Pagination interface con T
*/
export interface Pagination<T> {
  meta: {
    total: number,
    per_page: number,
    current_page: number,
    last_page: number,
    path: string,
    from: number | null,
    to: number | null,
  }

  links: {
    first: string | null,
    last: string | null,
    next: string | null,
    prev: string | null
  }

  data: T[]
}
