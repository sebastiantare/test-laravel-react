'use client'
import React, { useEffect, useState } from "react";
import { getCalle, getCalles } from "~/actions/calles";
import { Pagination, TableCalle, Calle } from "~/types";

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

  const [filtros, setFiltros] = useState();
  const [calles, setCalles] = useState<Pagination<TableCalle>>(initialPaginationState);

  useEffect(() => {
    getCalles()
      .then((data) => setCalles(data))
      .catch(e => console.log(e));
  }, []);

  useEffect(() => {
    console.log(calles);
  }, [calles]);

  const handlePagination = (page: string | null) => {
    if (page) {
      getCalles(page).then((data) => setCalles(data)).catch(e => console.log(e));
    }
  };

  const SearchTableCalles = ({ pageData }: { pageData: Pagination<TableCalle> }) => {
    return (
      <div className="overflow-x-auto">

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

        <div className="flex justify-between items-center mt-4 w-1/3 mx-auto">  <button
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
        <div className="mt-2 text-center">  Resultados: {pageData.meta.total}
        </div>

      </div>
    );
  };

  return (
    <>
      <SearchTableCalles pageData={calles} />
    </>
  );
}

export default Buscar;
