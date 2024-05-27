import React, { useState } from 'react';
import SimpleAnimatedComponent from '../../components/SimpleAnimatedComponent';

import ReactSlidy from 'react-slidy';
import 'react-slidy/lib/index.scss'
import 'react-slidy/lib/styles.css'
import './homeslider.css';

import Banner from "../../images/abreco-banner.webp";
import Lines from "../../images/abreco-lines.webp";

const SLIDES = [
    { src: Banner, content: <div className="slide-content"><h2>Making <br/>Lives Better</h2><span>Abreco Group</span></div> },
    { src: Banner, content: <div className="slide-content"><h2>Making <br/>Lives Better</h2><span>Abreco Group</span></div> },
    { src: Banner, content: <div className="slide-content"><h2>Making <br/>Lives Better</h2><span>Abreco Group</span></div> }
];

const createStyles = isActive => ({
    background: 'transparent',
    border: 0,
    color: isActive ? 'transparent' : 'transparent',
    background: isActive ? '#ee2346' : '#ffffff',
    cursor: 'pointer',
    fontSize: '20px',
    height: '10px',
    margin: '5px',
    borderRadius: '100px',
    width: isActive ? '50px' : '10px',
})

const HomeSlider = () => {

    const [actualSlide, setActualSlide] = useState(0)

    const updateSlide = ({ currentSlide }) => {
        setActualSlide(currentSlide)
    }

    return (
        <>
            <section className='siteBanner'>
                <ReactSlidy doAfterSlide={updateSlide} slide={actualSlide} infiniteLoop={true}>
                    {SLIDES.map(({ src, content }, index) => (
                        <div key={index} className="slide">
                            <img alt="" src={src} />
                            {content}
                        </div>
                    ))}
                </ReactSlidy>
                <div className="Dots">
                    {SLIDES.map((_, index) => {
                        return (
                            <button
                                key={index}
                                style={createStyles(index === actualSlide)}
                                onClick={() => updateSlide({ currentSlide: index })}
                            >&bull;</button>
                        )
                    })}
                </div>

                <div className='slanding1'>
                    <SimpleAnimatedComponent animation="animate__fadeInUpBig">
                        <div className='inner'></div>
                    </SimpleAnimatedComponent>
                </div>
                <div className='slanding2'>
                    <SimpleAnimatedComponent animation="animate__fadeInUpBig">
                        <div className='inner'></div>
                    </SimpleAnimatedComponent>
                </div>
            </section>
        </>
    )
}

export default HomeSlider