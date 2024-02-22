import { Link } from 'react-router-dom';
import { useState } from 'react';
import {FaTimes} from 'react-icons/fa';
import {CiMenuFries} from 'react-icons/ci';

const Nav = () => {

    const [click, setClick] = useState(false);
    const handleClick = () => setClick(!click);

    const content = <>
        <div className="lg:hidden block absolute top-16 w-full left-0 right-0 bg-slate-900 transition">
            <ul className='text-center text-xl p-20'>
                <Link spy={true} smooth={true} to="Inicio">
                    <li className='my-4 py-4 border-b border-slate-800 hover:bg-slate-800 hover:rounded'>Inicio</li>
                </Link>
                <Link spy={true} smooth={true} to="Acerca de">
                    <li className='my-4 py-4 border-b border-slate-800 hover:bg-slate-800 hover:rounded'>Acerca de</li>
                </Link>
                <Link spy={true} smooth={true} to="Alta de usuario">
                    <li className='my-4 py-4 border-b border-slate-800 hover:bg-slate-800 hover:rounded'>Alta de usuario</li>
                </Link>
            </ul>
        </div>
    </>

    return (
        <nav>
            <div className="h-10vh flex justify-between z-50 text-white lg:py-5 px-20 py-4">
                <div className="flex items-center flex-1">
                    <span className="text-3x1 font-bold">Logo</span>
                </div>
                <div className="lg:flex md:flex lg: flex-1 items-center justify-end font-normal hidden">
                    <div className="flex-10">
                        <ul className="flex gap-8 mr-16 text-[18px]">
                            <Link spy={true} smooth={true} to="Inicio">
                                <li className='hover:text-blue-500 transition border-b-2 border-slate-900 hover:border-blue-500'>Inicio</li>
                            </Link>
                            <Link spy={true} smooth={true} to="Acerca de">
                                <li className='hover:text-blue-500 transition border-b-2 border-slate-900 hover:border-blue-500'>Acerca de</li>
                            </Link>
                            <Link spy={true} smooth={true} to="Alta de usuario">
                                <li className='hover:text-blue-500 transition border-b-2 border-slate-900 hover:border-blue-500'>Alta de usuario</li>
                            </Link>
                        </ul>
                    </div>
                </div>
                <div>
                    {click && content}
                </div>

                <button className='block sm:hidden transition' onClick={handleClick}>
                    {click ? <FaTimes/> : <CiMenuFries/>}
                </button>
            </div>
        </nav>
    );
};

export default Nav;
