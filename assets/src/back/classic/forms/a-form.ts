import $ from 'jquery';
import { Component } from 'react';

import { CSS_NAMESPACE, ensureArray, TMany } from '@ithoughts/tooltip-glossary/back/common';
import { makeHtmlElement } from '@ithoughts/tooltip-glossary/common';

export type TSubmitHandler<TOut> = ( value: TOut ) => void;
export type TCloseHandler<TOut> = ( ( submit: true, value: TOut ) => void ) & ( ( submit: false ) => void );

export interface IFormHandlers<TOut> {
	onSubmit?: TMany<TSubmitHandler<TOut>>;
	onDiscard?: TMany<() => void>;
	onClose?: TMany<TCloseHandler<TOut>>;
}

export const makeAppRoot = ( appRootId: string ) => {
	const element = makeHtmlElement( { tag: 'div', content: '', attributes: { id: appRootId }} );
	document.body.appendChild( element );
	return element;
};

export abstract class AForm<TProps extends IFormHandlers<TOut>, TState, TOut>
	extends Component<TProps, TState> {
	protected static appRootId = `${CSS_NAMESPACE}-form-container`;
	private static _appRoot: HTMLElement | undefined;
	public static get appRoot() {
		if ( !this._appRoot ) {
			this._appRoot = makeAppRoot( this.appRootId );
		}
		return this._appRoot;
	}

	private readonly submitHandlers: Array<TSubmitHandler<TOut>> = [];
	private readonly closeHandlers: Array<TCloseHandler<TOut>> = [];
	private readonly discardHandlers: Array<() => void> = [];

	protected constructor( props: TProps ) {
		super( props );
		ensureArray( props.onSubmit ).forEach( submitHandler => this.onSubmit( submitHandler ) );
		ensureArray( props.onClose ).forEach( closeHandler => this.onClose( closeHandler ) );
		ensureArray( props.onDiscard ).forEach( discardHandler => this.onDiscard( discardHandler ) );
	}

	public abstract get formData(): TOut;

	// #region Submit
	public onSubmit( submitHandler: TSubmitHandler<TOut> ) {
		this.submitHandlers.push( submitHandler );
	}
	public removeSubmit( submitHandler: TSubmitHandler<TOut> ) {
		let foundHandlerIndex = -1;
		do {
			foundHandlerIndex = this.submitHandlers.indexOf( submitHandler );
			if ( foundHandlerIndex !== -1 ) {
				this.submitHandlers.slice( foundHandlerIndex, 1 );
			}
		} while ( foundHandlerIndex !== -1 );
	}
	protected submit() {
        console.log(this.formData)
		this.submitHandlers.forEach( submitHandler => submitHandler( this.formData ) );
		this.closeHandlers.forEach( closeHandler => closeHandler( true, this.formData ) );
	}
	// #endregion

	// #region Close
	public onClose( closeHandler: TCloseHandler<TOut> ) {
		this.closeHandlers.push( closeHandler );
	}
	public removeDelete( closeHandler: TCloseHandler<TOut> ) {
		let foundHandlerIndex = -1;
		do {
			foundHandlerIndex = this.closeHandlers.indexOf( closeHandler );
			if ( foundHandlerIndex !== -1 ) {
				this.closeHandlers.slice( foundHandlerIndex, 1 );
			}
		} while ( foundHandlerIndex !== -1 );
	}
	// #endregion

	// #region Discard
	public onDiscard( discardHandler: () => void ) {
		this.discardHandlers.push( discardHandler );
	}
	public removeDiscard( discardHandler: () => void ) {
		let foundHandlerIndex = -1;
		do {
			foundHandlerIndex = this.discardHandlers.indexOf( discardHandler );
			if ( foundHandlerIndex !== -1 ) {
				this.discardHandlers.slice( foundHandlerIndex, 1 );
			}
		} while ( foundHandlerIndex !== -1 );
	}
	protected discard() {
		this.discardHandlers.forEach( discardHandler => discardHandler() );
		this.closeHandlers.forEach( closeHandler => closeHandler( false ) );
	}
	// #endregion
}
