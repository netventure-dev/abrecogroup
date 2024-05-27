import React from 'react';
import AliceCarousel from 'react-alice-carousel';
import 'react-alice-carousel/lib/alice-carousel.css';
import Client1 from "../../images/client-1.webp";
import Client2 from "../../images/client-2.webp";
import Client3 from "../../images/client-3.webp";
import Client4 from "../../images/client-4.webp";
import Client5 from "../../images/client-5.webp";

import './clients.css';

const items = [
    <div className="item" data-value="1"><img src={Client1} alt="Abreco Group" /></div>,
    <div className="item" data-value="2"><img src={Client2} alt="Abreco Group" /></div>,
    <div className="item" data-value="3"><img src={Client3} alt="Abreco Group" /></div>,
    <div className="item" data-value="4"><img src={Client4} alt="Abreco Group" /></div>,
    <div className="item" data-value="5"><img src={Client5} alt="Abreco Group" /></div>,
    <div className="item" data-value="1"><img src={Client1} alt="Abreco Group" /></div>,
    <div className="item" data-value="2"><img src={Client2} alt="Abreco Group" /></div>,
    <div className="item" data-value="3"><img src={Client3} alt="Abreco Group" /></div>,
    <div className="item" data-value="4"><img src={Client4} alt="Abreco Group" /></div>,
    <div className="item" data-value="5"><img src={Client5} alt="Abreco Group" /></div>,
];

const responsive = {
    0: { items: 1 },
    568: { items: 2 },
    1024: { items: 3 },
    1200: { items: 4 },
    1368: { items: 5 },
};

const Clients = () => {
    return (
        <section className='clientsCarousel'>
            <div className='container'>
                <div className='data'>
                    <AliceCarousel 
                        mouseTracking
                        items={items}
                        autoPlayautoPlayInterval={2000}
                        infinite
                        disableButtonsControls 
                        disableDotsControls
                        responsive={responsive}
                    />
                </div>
            </div>
        </section>
    )
}

export default Clients