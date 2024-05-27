import React from 'react';
import { Link } from "react-router-dom";
import LifeAtAbreco from "../../images/lifeat.webp";
import './lifeat.css';

const LifeAt = () => {
  return (
    <section className='lifeAt'>
        <div className='container'>
            <div className='data'>
                <p>Life@Abreco</p>
                <h2>THIS IS HOW WE UNITED</h2>
                <img src={LifeAtAbreco} alt="" />
                <Link to="#">OUR GALLERY</Link>
            </div>
        </div>
    </section>
  )
}

export default LifeAt