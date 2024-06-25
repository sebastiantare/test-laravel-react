import type { TableCalle, Calle, Pagination } from "../types";

const baseUrl = process.env.NEXT_PUBLIC_API_HOST;

export async function getCalles(page: string | null = null, query = '', ciudad = '', provincia = '', region = ''): Promise<Pagination<TableCalle>> {
  try {
    let url = page ?? `${baseUrl}/calles?query=${query}`;
    if (page) url = `${url}&query=${query}`

    const response = await fetch(url);
    const data = await response.json() as Pagination<TableCalle>;
    return data;
  } catch (error) {
    console.log(error);
    throw error;
  }
}


export async function getCalle(id: number): Promise<Calle> {
  try {
    const response = await fetch(baseUrl + `/calles/${id}`);
    const data = await response.json() as Calle;
    return data;
  } catch (error) {
    console.log(error);
    throw error;
  }
}

export async function createCalle(data: Calle | { nombre: string, ciudad_id: number }) {
  try {
    const response = await fetch(baseUrl + `/calles`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(data),
    });

    if (!response.ok) {
      throw new Error('Network response was not ok');
    }

    return response;
  } catch (error) {
    console.log(error);
  }
}

export async function deleteCalle(id: number) {
  try {
    const response = await fetch(baseUrl + `/calles/${id}`, {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json',
      },
    });

    if (!response.ok) {
      throw new Error('Network response was not ok');
    }

    const result = await response.json() as Calle;

    return result;
  } catch (error) {
    console.log(error);
  }
}

export async function updateCalle(data: TableCalle | { id: number, nombre: string, ciudad_id: number }) {
  try {
    const response = await fetch(baseUrl + `/calles/${data.id}`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(data),
    });

    if (!response.ok) {
      throw new Error('Network response was not ok');
    }

    return response;
  } catch (error) {
    console.log(error);
  }
}
