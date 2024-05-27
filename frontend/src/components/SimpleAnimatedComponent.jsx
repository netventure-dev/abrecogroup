import React from 'react'

const SimpleAnimatedComponent = ({ animation, id, children }) => {
  return (
    <div id={id} className={`animate__animated ${animation}`}>
        {children}
    </div>
  )
}

export default SimpleAnimatedComponent