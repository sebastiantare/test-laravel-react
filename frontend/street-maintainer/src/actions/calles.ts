import { TableCalle, Calle, Pagination } from "../types";

const baseUrl = process.env.NEXT_PUBLIC_API_HOST;

export async function getCalles(page: string | null = baseUrl + '/calles'): Promise<Pagination<TableCalle>> {
  try {
    const url = page ?? `${baseUrl}/calles`;
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

export async function createCalle(data: Calle) {
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
