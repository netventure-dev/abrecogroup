import React from 'react';
import { Link } from "react-router-dom";

import './brands.css';

import Freight from "../../images/freight.webp";

const Brands = () => {
  return (
    <>
        <section className='brands'>
            <div className='container'>
                <div className='row'>
                    <div className='data'>
                        <div className='item'>
                            <p>We Believe in Ethics</p>
                            <h2>OUR BUSINESS</h2>
                            <small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. <br />Aenean pretium enim mauris, id posuere augue <br />ullamcorper at.</small>
                        </div>
                        <div className='item'>
                            <div className='imgWrapper'><img src={Freight} alt="" /></div>
                            <h5>Freight</h5>
                            <Link to="">Link</Link>
                        </div>
                        <div className='item'>
                            <div className='imgWrapper'><img src={Freight} alt="" /></div>
                            <h5>Constructions / Real Estate</h5>
                            <Link to="">Link</Link>
                        </div>
                        <div className='item'>
                            <div className='imgWrapper'><img src={Freight} alt="" /></div>
                            <h5>Freight</h5>
                            <Link to="">Link</Link>
                        </div>
                        <div className='item'>
                            <div className='imgWrapper'><img src={Freight} alt="" /></div>
                            <h5>Freight</h5>
                            <Link to="">Link</Link>
                        </div>
                        <div className='item'>
                            <div className='imgWrapper'><img src={Freight} alt="" /></div>
                            <h5>Freight</h5>
                            <Link to="">Link</Link>
                        </div>
                        <div className='item'>
                            <div className='imgWrapper'><img src={Freight} alt="" /></div>
                            <h5>Freight</h5>
                            <Link to="">Link</Link>
                        </div>
                        <div className='item'>
                            <div className='imgWrapper'><img src={Freight} alt="" /></div>
                            <h5>Freight</h5>
                            <Link to="">Link</Link>
                        </div>
                        <div className='item'>
                            <div className='imgWrapper'><img src={Freight} alt="" /></div>
                            <h5>Freight</h5>
                            <Link to="">Link</Link>
                        </div>
                        <div className='item'>
                            <div className='imgWrapper'><img src={Freight} alt="" /></div>
                            <h5>Freight</h5>
                            <Link to="">Link</Link>
                        </div>
                        <div className='item'>
                            <div className='imgWrapper'><img src={Freight} alt="" /></div>
                            <h5>Freight</h5>
                            <Link to="">Link</Link>
                        </div>
                        <div className='item'>
                            <div className='imgWrapper'><img src={Freight} alt="" /></div>
                            <h5>Freight</h5>
                            <Link to="">Link</Link>
                        </div>
                        <div className='item'>
                            <div className='imgWrapper'><img src={Freight} alt="" /></div>
                            <h5>Freight</h5>
                            <Link to="">Link</Link>
                        </div>
                        <div className='item'>
                            <div className='imgWrapper'><img src={Freight} alt="" /></div>
                            <h5>Freight</h5>
                            <Link to="">Link</Link>
                        </div>
                        <div className='item'>
                            <div className='imgWrapper'><img src={Freight} alt="" /></div>
                            <h5>Freight</h5>
                            <Link to="">Link</Link>
                        </div>
                        <div className='item'>
                            <div className='imgWrapper'><img src={Freight} alt="" /></div>
                            <h5>Freight</h5>
                            <Link to="">Link</Link>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </>
  )
}

export default Brands