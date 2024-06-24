'use client'
import React, { useEffect, useState } from "react";
import { getCalle, getCalles } from "~/actions/calles";
import type { Pagination, TableCalle, Calle } from "~/types";

const initialPaginationState: Pagination<TableCalle> = {
  meta: {
    total: 0,
    per_page: 0,
    current_page: 0,
    last_page: 0,
    path: '',
    from: null,
    to: null,
  },
  links: {
    first: null,
    last: null,
    next: null,
    prev: null,
  },
  data: []
};

const Buscar = ({ }) => {
  const [filtros, setFiltros] = useState<string>('');
  const [calles, setCalles] = useState<Pagination<TableCalle>>(initialPaginationState);

  useEffect(() => {
    getCalles()
      .then((data) => setCalles(data))
      .catch(e => console.log(e));
  }, []);

  useEffect(() => {
    console.log(calles);
  }, [calles]);

  useEffect(() => {
    getCalles(null, filtros)
      .then((data) => setCalles(data))
      .catch(e => console.log(e));
  }, [filtros]);

  const handlePagination = (page: string | null) => {
    if (page) {
      getCalles(page, filtros).then((data) => setCalles(data)).catch(e => console.log(e));
    }
  };

  const SearchTableCalles = ({ pageData }: { pageData: Pagination<TableCalle> }) => {
    return (
      <div className="">

        <table className="min-w-full bg-white border border-gray-200">
          <thead>
            <tr>
              <th className="py-2 px-4 border-b">Calle</th>
              <th className="py-2 px-4 border-b">Ciudad</th>
              <th className="py-2 px-4 border-b">Provincia</th>
              <th className="py-2 px-4 border-b">Región</th>
            </tr>
          </thead>
          <tbody className="text-sm">
            {pageData.data.map((calle: TableCalle, index: number) => (
              <tr key={index}>
                <td className="py-2 px-4 border-b">{calle.nombre}</td>
                <td className="py-2 px-4 border-b">{calle.ciudad}</td>
                <td className="py-2 px-4 border-b">{calle.provincia}</td>
                <td className="py-2 px-4 border-b">{calle.region}</td>
              </tr>
            ))}
          </tbody>
        </table>

        <div className="flex justify-between items-center mt-4 w-1/3 mx-auto text-sm">
          <button
            className="px-4 py-2 bg-gray-200 text-gray-700 rounded disabled:opacity-50"
            onClick={() => handlePagination(pageData.links.prev)}
            disabled={!pageData.links.prev}
          >
            Anterior
          </button>
          <span>
            Página {pageData.meta.current_page} de {pageData.meta.last_page}
          </span>
          <button
            className="px-4 py-2 bg-gray-200 text-gray-700 rounded disabled:opacity-50"
            onClick={() => handlePagination(pageData.links.next)}
            disabled={!pageData.links.next}
          >
            Siguiente
          </button>
        </div>
        <div className="mt-2 text-center text-sm text-gray-400">
          Resultados: {pageData.meta.total}
        </div>

      </div>
    );
  };

  return (
    <div className="flex flex-col m-4">
      <div className="flex flex-row">
        <div className="p-4">
          <label htmlFor="textInput" className="block text-sm font-medium text-gray-700">Buscar por:</label>
          <input
            placeholder="Nombre Calle"
            type="text"
            id="textInput"
            name="textInput"
            className="mt-0 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            value={filtros}
            onChange={(e) => setFiltros(e.target.value)}
          />
        </div>
      </div>
      <SearchTableCalles pageData={calles} />
    </div>
  );
}

export default Buscar;
