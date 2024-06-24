'use client'
import React from "react";
import Link from 'next/link';
import { usePathname } from "next/navigation";

const Navigation = () => {
  const pathname = usePathname();

  return (
    <div className="w-full h-20 bg-gray-100 sticky top-0">
      <div className="container mx-auto px-4 h-full">
        <div className="flex justify-between items-center h-full">
          <ul className="hidden md:flex p-4 gap-x-6 text-black ">
            <li>
              <Link href="/" >
                <p className={`link ${pathname === '/' ? 'active' : ''}`}>Home</p>
              </Link>
            </li>
            <li>
              <Link href="/buscar">
                <p className={`link ${pathname === '/buscar' ? 'active' : ''}`}>Buscar</p>
              </Link>
            </li>
            <li>
              <Link href="/mantenedor" >
                <p className={`link ${pathname === '/mantenedor' ? 'active' : ''}`}>Mantenedor</p>
              </Link>
            </li>
          </ul>
        </div>
      </div>
    </div>
  );
};

export default Navigation;
