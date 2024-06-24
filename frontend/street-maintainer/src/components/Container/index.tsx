import React, { ReactNode } from 'react';

interface ContainerProps {
  children: ReactNode;
}

const Container = ({ children }: ContainerProps) => {
  return (
    <div className="container mx-auto px-4 sm:px-6 lg:px-8 max-w-screen-xl custom">
      {children}
    </div>
  );
};

export default Container;
