import React from 'react';
import { useInView } from 'react-intersection-observer';

const AnimatedComponent = ({ animation, id, children }) => {
  const { ref, inView } = useInView({
    triggerOnce: true,
    threshold: 0.1,
  });

  return (
    <div ref={ref} id={id} className={`animate__animated ${inView ? animation : ''}`}>
      {children}
    </div>
  );
};

export default AnimatedComponent;