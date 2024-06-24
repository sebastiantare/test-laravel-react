import { Region, Provincia } from "../types";

const baseUrl = process.env.NEXT_PUBLIC_API_HOST;

export async function getRegiones(): Promise<Region[]> {
  try {
    const url = `${baseUrl}/regiones`;
    const response = await fetch(url);
    const data = await response.json() as Region[];
    return data;
  } catch (error) {
    console.log(error);
    throw error;
  }
}

export async function getRegion(id: number): Promise<Region> {
  try {
    const response = await fetch(`${baseUrl}/regiones/${id}`);
    const data = await response.json() as Region;
    return data;
  } catch (error) {
    console.log(error);
    throw error;
  }
}

export async function createRegion(data: Region) {
  try {
    const response = await fetch(baseUrl + `/regiones`, {
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

export async function getProvinciasFromRegion(id: number): Promise<Provincia[]> {
  try {
    const response = await fetch(`${baseUrl}/regiones/${id}/provincias`);
    const data = await response.json() as Provincia[];
    return data;
  } catch (error) {
    console.log(error);
    throw error;
  }
}
