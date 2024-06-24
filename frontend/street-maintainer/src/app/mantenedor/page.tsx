'use client'
import React, { useState, useEffect, useId } from "react";
import { getRegiones, getProvinciasFromRegion } from "~/actions/regiones";
import { getCiudadesFromProvincia } from "~/actions/provincias";
import { getCallesFromCiudades } from "~/actions/ciudades";
import { Provincia, Region, SelectType, Ciudad } from "~/types";
import Select from 'react-select'

const Mantenedor = () => {
  const [regiones, setRegiones] = useState<Region[]>([]);
  const [provincias, setProvincias] = useState<Provincia[]>([]);
  const [ciudades, setCiudades] = useState<Ciudad[]>([]);

  const [selectedRegion, setSelectedRegion] = useState<SelectType<Region> | undefined>(undefined);
  const [selectedProvincia, setSelectedProvincia] = useState<SelectType<Provincia> | undefined>(undefined);
  const [selectedCiudad, setSelectedCiudad] = useState<SelectType<Ciudad> | undefined>(undefined);

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

  const handleRegiones = (event: SelectType<Region>) => {
    setSelectedRegion(event);
    setSelectedProvincia(null);
    setSelectedCiudad(null);
  };

  const handleProvincias = (event: SelectType<Provincia>) => {
    setSelectedProvincia(event);
    setSelectedCiudad(null);
  };

  const handleCiudades = (event: SelectType<Ciudad>) => {
    setSelectedCiudad(event);
  };

  const id = useId();

  return (
    <div className='flex flex-row items-center text-sm'>

      <div className='p-4'>
        <label htmlFor="textInput" className="block text-sm font-medium text-gray-700">Región:</label>

        <Select
          options={regiones.map((region) => ({ value: region, label: region.nombre }))}
          onChange={(event) => handleRegiones(event)}
          value={selectedRegion}
          instanceId={id}
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
        />
      </div>
      <div className="p-4">
        <label htmlFor="textInput" className="block text-sm font-medium text-gray-700">Nombre Calle:</label>
        <input
          type="text"
          id="textInput"
          name="textInput"
          className="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
        />
      </div>
    </div>
  );
};

export default Mantenedor;
