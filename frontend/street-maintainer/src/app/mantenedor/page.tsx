'use client'
import React, { useState, useEffect, useId } from "react";
import { getRegiones, getProvinciasFromRegion } from "~/actions/regiones";
import { getCiudadesFromProvincia } from "~/actions/provincias";
import type { Provincia, Region, SelectType, Ciudad } from "~/types";
import Select from 'react-select';
import { createCalle } from "~/actions/calles";

const Mantenedor = () => {
  const [regiones, setRegiones] = useState<Region[]>([]);
  const [provincias, setProvincias] = useState<Provincia[]>([]);
  const [ciudades, setCiudades] = useState<Ciudad[]>([]);
  const [calleName, setCalleName] = useState<string>('');

  const [selectedRegion, setSelectedRegion] = useState<SelectType<Region> | null>(null);
  const [selectedProvincia, setSelectedProvincia] = useState<SelectType<Provincia> | null>(null);
  const [selectedCiudad, setSelectedCiudad] = useState<SelectType<Ciudad> | null>(null);

  useEffect(() => {
    getRegiones()
      .then((data) => setRegiones(data))
      .catch(e => console.log(e));
  }, []);

  useEffect(() => {
    if (selectedRegion) {
      getProvinciasFromRegion(selectedRegion.value.id)
        .then(data => setProvincias(data))
        .catch(e => console.log(e));
    } else {
      setProvincias([]);
    }
  }, [selectedRegion]);

  useEffect(() => {
    if (selectedProvincia) {
      getCiudadesFromProvincia(selectedProvincia.value.id)
        .then(data => setCiudades(data))
        .catch(e => console.log(e));
    } else {
      setCiudades([]);
    }
  }, [selectedProvincia]);

  const handleRegiones = (event: SelectType<Region> | null) => {
    setSelectedRegion(event);
    setSelectedProvincia(null);
    setSelectedCiudad(null);
  };

  const handleProvincias = (event: SelectType<Provincia> | null) => {
    setSelectedProvincia(event);
    setSelectedCiudad(null);
  };

  const handleCiudades = (event: SelectType<Ciudad> | null) => {
    setSelectedCiudad(event);
  };

  const handleCreateCalle = () => {
    if (!calleName) {
      alert("El nombre de la calle no puede estar vacío");
      return;
    }

    if (!selectedRegion || !selectedProvincia || !selectedCiudad) {
      alert("Debe seleccionar región, provincia y ciudad");
      return;
    }

    if (calleName.length < 4) {
      alert("Debe ingresar un nombre con más de 5 caracteres.");
      return;
    }

    if (calleName.length > 127) {
      alert("Debe ingresar un nombre de menos de 128 caracteres.");
      return;
    }

    const regex = /^[A-Za-zÁÉÍÓÚáéíóúÑñÜü'"\- ][\wÁÉÍÓÚáéíóúÑñÜü'"\- ]*$/;

    if (!regex.test(calleName)) {
      alert("Debe ingresar un nombre válido.");
      return;
    }

    const newCalle = {
      nombre: calleName,
      ciudad_id: selectedCiudad.value.id
    };

    createCalle(newCalle)
      .then(response => {
        alert("Calle creada exitosamente");
        setCalleName("");
        setSelectedRegion(null);
        setSelectedProvincia(null);
        setSelectedCiudad(null);
      })
      .catch(error => {
        console.log(error);
        alert("Hubo un error al crear la calle");
      });
  }

  const id = useId();

  return (
    <div className="flex flex-col">
      <p className="p-4 text-gray-800 text-2xl title-shadow">Nueva Calle</p>
      <div className='flex flex-row items-center text-sm'>

        <div className='p-4'>
          <label htmlFor="textInput" className="block text-sm font-medium text-gray-700">Región:</label>

          <Select
            options={regiones.map((region) => ({ value: region, label: region.nombre }))}
            onChange={(event) => handleRegiones(event)}
            value={selectedRegion}
            instanceId={id}
            styles={{
              control: (provided) => ({
                ...provided,
                width: '200px',
              }),
            }}
          />
        </div>
        <div className='p-4'>
          <label htmlFor="textInput" className="block text-sm font-medium text-gray-700">Provincia:</label>

          <Select
            options={provincias.map((provincia) => ({ value: provincia, label: provincia.nombre }))}
            onChange={(event) => handleProvincias(event)}
            value={selectedProvincia}
            instanceId={id}
            isDisabled={!selectedRegion}
            styles={{
              control: (provided) => ({
                ...provided,
                width: '200px',
              }),
            }}
          />
        </div>
        <div className='p-4'>
          <label htmlFor="textInput" className="block text-sm font-medium text-gray-700">Ciudad:</label>

          <Select
            options={ciudades.map((ciudad) => ({ value: ciudad, label: ciudad.nombre }))}
            onChange={(event) => handleCiudades(event)}
            value={selectedCiudad}
            instanceId={id}
            isDisabled={!selectedProvincia}
            styles={{
              control: (provided) => ({
                ...provided,
                width: '200px',
              }),
            }}
          />
        </div>
        <div className="p-4">
          <label htmlFor="textInput" className="block text-sm font-medium text-gray-700">Nombre Calle:</label>
          <input
            type="text"
            placeholder="Ej: Calle Bonita"
            id="textInput"
            name="textInput"
            className="mt-0 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            value={calleName}
            onChange={(e) => setCalleName(e.target.value)}
          />
        </div>
        <div className="p-4 flex justify-end items-center space-x-2">
          <button
            onClick={handleCreateCalle}
            className="mt-5 py-2 px-8 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out"
          >
            Crear
          </button>
        </div>
      </div>
    </div>
  );
};

export default Mantenedor;
