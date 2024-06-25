import React from "react";
import type { Calle, TableCalle } from "~/types";

type DeleteModalProps = {
  isOpen: boolean;
  onClose: () => void;
  onDelete: (id: number) => void;
  calle: TableCalle | null;
};

const DeleteModal = ({ isOpen, onClose, onDelete, calle }: DeleteModalProps) => {
  if (!isOpen || !calle) return null;

  return (
    <div className="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
      <div className="bg-white p-6 rounded shadow-lg">
        <h2 className="text-lg font-bold mb-4">Eliminar Calle</h2>
        <p>Seguro que desea eliminar la calle {calle?.nombre}?</p>
        <div className="flex justify-end mt-4">
          <button
            onClick={onClose}
            className="px-4 py-2 bg-gray-300 rounded mr-2"
          >
            Cancelar
          </button>
          <button
            onClick={() => onDelete(calle.id)}
            className="px-4 py-2 bg-red-600 text-white rounded"
          >
            Eliminar
          </button>
        </div>
      </div>
    </div>
  );
};

export default DeleteModal;
