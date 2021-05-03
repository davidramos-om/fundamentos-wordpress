import { registerBlockType } from '@wordpress/blocks';
// const { registerBlockType } = window.wp.blocks;
import { TextControl, PanelBody, PanelRow } from '@wordpress/components';
import { InspectorControls } from '@wordpress/block-editor';
import ServerSideRender from '@wordpress/server-side-render';

registerBlockType('pg/basic', {
    title: 'Basic Block',
    description: 'Block usado para el editor en react',
    icon: "smiley",
    category: "text",
    keywords: [ 'wordpress', 'gutenberg', 'react-block' ],
    attributes: {
        content: {
            type: 'string',
            default: 'Hello world!!'
        }
    },
    // edit: () => <h2>Hello World</h2>,
    // save: () => <h2>Hello World</h2>
    edit: (props) => {
        const { attributes: { content }, setAttributes, className } = props;
        const handlerOnChangeInput = (newContent) => {
            setAttributes({ content: newContent })
        }

        return (
            <>
                <InspectorControls>
                    <PanelBody
                        title="Modificar texto del Bloque Básico"
                        initialOpen={false}
                    >
                        <PanelRow>
                            <TextControl
                                label="Complete el campo"
                                class={className}
                                value={content}
                                onChange={handlerOnChangeInput}
                            />
                        </PanelRow>
                    </PanelBody>
                </InspectorControls>
                <ServerSideRender
                    block="pg/basic"
                    attributes={props.attributes}
                />
            </>
        );
    },

    // save: (props) => <h2 class={props.className}>{props.attributes.content}</h2>
    save: () => null //PHP se encargará del renderizado dinamico    
});


registerBlockType('pg/table-block', {
    title: 'Basic Table Block',
    description: 'Table-Block usado para el editor en react',
    icon: "editor-table",
    category: "text",
    keywords: [ 'wordpress', 'gutenberg', 'react-block', 'table' ],
    attributes: {
        content: {
            type: 'string',
            default: [
                { title: 'M1 sera una sorpresa', description: 'Intro al nuevo procesador de Apple' },
                { title: 'Top 10 sitios web en JS', description: 'Sitios web al que todo desarrollador deberia entrar cada dia' }
            ]
        }
    },
    edit: (props) => {
        const { attributes: { content }, setAttributes, className } = props;
        const handlerOnChangeInput = (newContent) => {
            setAttributes({ content: newContent })
        }

        console.info("content", content);

        return (
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Descripción</th>
                    </tr>
                </thead>
                <tbody>

                    {content.map((r, index) => {
                        return (
                            <tr>
                                <th scope="row">{index + 1}</th>
                                <td>{r.title}</td>
                                <td>{r.description}</td>
                            </tr>
                        );
                    })}
                </tbody>
            </table>
        );
    },
    save: (props) => {
        const { attributes: { content } } = props;

        return (
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Descripción</th>
                    </tr>
                </thead>
                <tbody>

                    {content.map((r, index) => {
                        return (
                            <tr>
                                <th scope="row">{index + 1}</th>
                                <td>{r.title}</td>
                                <td>{r.description}</td>
                            </tr>
                        );
                    })}
                </tbody>
            </table>
        );
    }
});