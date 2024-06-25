import type { Ciudad, Calle } from "../types";

const baseUrl = process.env.NEXT_PUBLIC_API_HOST;

export async function getCiudades(): Promise<Ciudad[]> {
  try {
    const url = `${baseUrl}/ciudades`;
    const response = await fetch(url);
    const data = await response.json() as Ciudad[];
    return data;
  } catch (error) {
    console.log(error);
    throw error;
  }
}

export async function getProvincia(id: number): Promise<Ciudad> {
  try {
    const response = await fetch(`${baseUrl}/ciudades/${id}`);
    const data = await response.json() as Ciudad;
    return data;
  } catch (error) {
    console.log(error);
    throw error;
  }
}

export async function createProvincia(data: Ciudad) {
  try {
    const response = await fetch(baseUrl + `/ciudades`, {
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

export async function getCallesFromCiudades(id: number): Promise<Calle[]> {
  try {
    const response = await fetch(`${baseUrl}/ciudades/${id}/calles`);
    const data = await response.json() as Calle[];
    return data;
  } catch (error) {
    console.log(error);
    throw error;
  }
}
