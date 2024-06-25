'use client'
import Select from 'react-select';
import React, { useEffect, useState, useId } from "react";
import { updateCalle } from "~/actions/calles";
import { getCiudadesFromProvincia } from "~/actions/provincias";
import { getProvinciasFromRegion, getRegiones } from "~/actions/regiones";
import type { Calle, Ciudad, Provincia, Region, SelectType, TableCalle } from "~/types";

type UpdateModalProps = {
  isOpen: boolean;
  onClose: () => void;
  onUpdate: (updatedCalle: Calle) => void;
  calle: TableCalle | null;
};

const UpdateModal = ({ isOpen, onClose, onUpdate, calle }: UpdateModalProps) => {

  const [regiones, setRegiones] = useState<Region[]>([]);
  const [provincias, setProvincias] = useState<Provincia[]>([]);
  const [ciudades, setCiudades] = useState<Ciudad[]>([]);
  const [calleName, setCalleName] = useState<string>('');

  const [selectedRegion, setSelectedRegion] = useState<SelectType<Region> | null>(null);
  const [selectedProvincia, setSelectedProvincia] = useState<SelectType<Provincia> | null>(null);
  const [selectedCiudad, setSelectedCiudad] = useState<SelectType<Ciudad> | null>(null);

  const findRegionByName = (regions: Region[], targetName: string): Region | undefined => {
    return regions.find(region => region.nombre === targetName);
  };

  const findProvinciaByName = (provincias: Provincia[], targetName: string): Provincia | undefined => {
    return provincias.find(provincia => provincia.nombre === targetName);
  };

  const findCiudadByName = (ciudades: Ciudad[], targetName: string): Ciudad | undefined => {
    return ciudades.find(ciudad => ciudad.nombre === targetName);
  };

  useEffect(() => {
    if (!calle) return;
    getRegiones()
      .then((data) => {
        setRegiones(data);
      })
      .catch(e => console.log(e));
    setCalleName(calle.nombre);
  }, [calle]);

  useEffect(() => {
    if (regiones && calle) {
      const region = findRegionByName(regiones, calle.region);
      if (!region) return;
      setSelectedRegion({ value: region, label: calle.region });
    }
  }, [regiones, calle]);

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
    if (provincias && calle) {
      const provincia = findProvinciaByName(provincias, calle.provincia);
      if (!provincia) return;
      setSelectedProvincia({ value: provincia, label: calle.provincia });
    }
  }, [provincias, calle]);

  useEffect(() => {
    if (selectedProvincia) {
      getCiudadesFromProvincia(selectedProvincia.value.id)
        .then(data => setCiudades(data))
        .catch(e => console.log(e));
    } else {
      setCiudades([]);
    }
  }, [selectedProvincia]);

  useEffect(() => {
    if (ciudades && calle) {
      const ciudad = findCiudadByName(ciudades, calle.ciudad);
      if (!ciudad) return;
      setSelectedCiudad({ value: ciudad, label: calle.ciudad });
    }
  }, [calle, ciudades]);

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

  const id = useId();

  const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setCalleName(e.target.value);
  };

  const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();

    if (calle) {
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

      const newCalle = {
        id: calle.id,
        nombre: calleName,
        ciudad_id: selectedCiudad.value.id
      };

      onUpdate(newCalle);
    }
  };

  if (!isOpen || !calle) return null;

  return (
    <div className="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
      <div className="bg-white p-6 rounded shadow-lg">
        <h2 className="text-lg font-bold mb-4">Update Calle</h2>
        <form onSubmit={handleSubmit}>

          <div className="mb-4">
            <label className="block text-sm font-medium text-gray-700">Nombre</label>
            <input
              type="text"
              name="nombre"
              value={calleName}
              onChange={handleChange}
              className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            />
          </div>

          <div className='mb-4'>
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
                  width: `250px`,
                }),
              }}
            />
          </div>

          <div className='mb-4'>
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
                  width: `250px`,
                }),
              }}
            />
          </div>

          <div className='mb-4'>
            <label htmlFor="textInput" className="block text-sm font-medium text-gray-700">Región:</label>

            <Select
              options={regiones.map((region) => ({ value: region, label: region.nombre }))}
              onChange={(event) => handleRegiones(event)}
              value={selectedRegion}
              instanceId={id}
              styles={{
                control: (provided) => ({
                  ...provided,
                  width: `250px`,
                }),
              }}
            />
          </div>

          <div className="flex justify-end">
            <button
              onClick={onClose}
              className="px-4 py-2 bg-gray-300 rounded mr-2"
            >
              Cancelar
            </button>
            <button
              type="submit"
              className="px-4 py-2 bg-blue-600 text-white rounded"
            >
              Actualizar
            </button>
          </div>
        </form>
      </div>
    </div>
  );
};

export default UpdateModal;
