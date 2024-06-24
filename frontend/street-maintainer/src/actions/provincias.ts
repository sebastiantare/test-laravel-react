import { Provincia, Ciudad } from "../types";

const baseUrl = process.env.NEXT_PUBLIC_API_HOST;

export async function getProvincias(): Promise<Provincia[]> {
  try {
    const url = `${baseUrl}/provincias`;
    const response = await fetch(url);
    const data = await response.json() as Provincia[];
    return data;
  } catch (error) {
    console.log(error);
    throw error;
  }
}

export async function getProvincia(id: number): Promise<Provincia> {
  try {
    const response = await fetch(`${baseUrl}/provincias/${id}`);
    const data = await response.json() as Provincia;
    return data;
  } catch (error) {
    console.log(error);
    throw error;
  }
}

export async function createProvincia(data: Provincia) {
  try {
    const response = await fetch(baseUrl + `/provincias`, {
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
    throw error;
  }
}

export async function getCiudadesFromProvincia(id: number): Promise<Ciudad[]> {
  try {
    const response = await fetch(`${baseUrl}/provincias/${id}/ciudades`);
    const data = await response.json() as Ciudad[];
    return data;
  } catch (error) {
    console.log(error);
    throw error;
  }
}
