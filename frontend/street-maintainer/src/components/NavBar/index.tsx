import React from "react";
import Link from 'next/link';

const Navigation = () => {
  return (
    <div className="w-full h-20 bg-gray-100 sticky top-0">
      <div className="container mx-auto px-4 h-full">
        <div className="flex justify-between items-center h-full">
          <ul className="hidden md:flex gap-x-6 text-black ">
            <li>
              <Link href="/">
                <p>Home</p>
              </Link>
            </li>
            <li>
              <Link href="/about">
                <p>About Us</p>
              </Link>
            </li>
          </ul>
        </div>
      </div>
    </div>
  );
};

export default Navigation;
