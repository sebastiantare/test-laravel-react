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
                <div className={`link ${pathname === '/' ? 'active' : ''} m-4`}>
                  <p>Home</p>
                </div>
              </Link>
            </li>
            <li>
              <Link href="/buscar">
                <div className={`link ${pathname === '/buscar' ? 'active' : ''} m-4`}>
                  <p>Buscar</p>
                </div>
              </Link>
            </li>
            <li>
              <Link href="/mantenedor" >
                <div className={`link ${pathname === '/mantenedor' ? 'active' : ''} m-4`}>
                  <p>Mantenedor</p>
                </div>
              </Link>
            </li>
          </ul>
        </div>
      </div>
    </div>
  );
};

export default Navigation;
