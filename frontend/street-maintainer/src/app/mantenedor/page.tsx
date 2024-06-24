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
    <div className='flex flex-row items-center'>
      <div className='p-4'>
        <Select
          options={regiones.map((region) => ({ value: region, label: region.nombre }))}
          onChange={(event) => handleRegiones(event)}
          value={selectedRegion}
          instanceId={id}
        />
      </div>
      <div className='p-4'>
          <Select
            options={provincias.map((provincia) => ({ value: provincia, label: provincia.nombre }))}
            onChange={(event) => handleProvincias(event)}
            value={selectedProvincia}
            instanceId={id}
            isDisabled={!selectedRegion}
          />
      </div>
      <div className='p-4'>
          <Select
            options={ciudades.map((ciudad) => ({ value: ciudad, label: ciudad.nombre }))}
            onChange={(event) => handleCiudades(event)}
            value={selectedCiudad}
            instanceId={id}
            isDisabled={!selectedProvincia}
          />
      </div>
    </div>
  );
};

export default Mantenedor;
